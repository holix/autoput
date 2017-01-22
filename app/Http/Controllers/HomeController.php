<?php

namespace App\Http\Controllers;

use App\Category;
use App\Claim;
use App\Distance;
use App\Invoice;
use App\Price;
use App\Tollbooth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->pluck('name', 'id');
        $mode = session('mode');
        $claims = Claim::with('user', 'category', 'tollbooth')->where('tollbooth_id', session('tollbooth_id'))->orderBy('id', 'DESC')->get();
        $invoices = Invoice::with('tollbooth', 'user', 'claim.user', 'claim.category', 'claim.tollbooth')->where('tollbooth_id', session('tollbooth_id'))->orderBy('id', 'DESC')->get();
        $t = Tollbooth::find(session('tollbooth_id'));
        return view('home', compact('mode', 'categories', 'claims', 'invoices', 't'));
    }

    public function distances()
    {
        $tollbooths = Tollbooth::orderBy('id', 'ASC')->get();
        $width = 100 / ($tollbooths->count() + 1);

        $distances = Distance::get();
        $distanceValues = [];
        foreach($distances as $distance) {
            if (!isset($distanceValues[$distance->tollbooth1_id])) {
                $distanceValues[$distance->tollbooth1_id] = [];
            }
            if (!isset($distanceValues[$distance->tollbooth2_id])) {
                $distanceValues[$distance->tollbooth2_id] = [];
            }
            $distanceValues[$distance->tollbooth1_id][$distance->tollbooth2_id] = $distance->value;
            $distanceValues[$distance->tollbooth2_id][$distance->tollbooth1_id] = $distance->value;
        }
        return view('distances', compact('tollbooths', 'width', 'distanceValues'));
    }

    public function updateDistances(Request $request)
    {
        $distances = $request->get('distances', []);

        foreach($distances as $from => $from_distances) {
            foreach($from_distances as $to => $value) {
                if($from < $to) {
                    $distance = Distance::firstOrNew(['tollbooth1_id' => $from, 'tollbooth2_id' => $to]);
                    $distance->value = $value;
                    $distance->save();
                }
            }
        }

        return back();
    }

    public function prices($category_id = 0)
    {
        $category = Category::find($category_id);
        if(!$category) {
            return redirect('prices/' . Category::first()->id);
        }
        $categories = Category::orderBy('id', 'ASC')->get()->pluck('name', 'id');
        $tollbooths = Tollbooth::orderBy('id', 'ASC')->get();
        $width = 100 / ($tollbooths->count() + 1);

        $prices = Price::where('category_id', $category->id)->get();
        $priceValues = [];
        foreach($prices as $price) {
            if (!isset($priceValues[$price->tollbooth1_id])) {
                $priceValues[$price->tollbooth1_id] = [];
            }
            if (!isset($priceValues[$price->tollbooth2_id])) {
                $priceValues[$price->tollbooth2_id] = [];
            }
            $priceValues[$price->tollbooth1_id][$price->tollbooth2_id] = $price->value;
            $priceValues[$price->tollbooth2_id][$price->tollbooth1_id] = $price->value;
        }
        return view('prices', compact('tollbooths', 'width', 'priceValues', 'category', 'categories'));
    }

    public function updatePrices(Request $request, $category_id)
    {
        $category = Category::findOrFail($category_id);

        $prices = $request->get('prices', []);

        foreach($prices as $from => $from_prices) {
            foreach($from_prices as $to => $value) {
                if($from < $to) {
                    $price = Price::firstOrNew(['category_id' => $category->id, 'tollbooth1_id' => $from, 'tollbooth2_id' => $to]);
                    $price->value = $value;
                    $price->save();
                }
            }
        }

        return back();
    }

    public function mode()
    {
        $tollbooths = Tollbooth::orderBy('id', 'ASC')->get();

        return view('mode', compact('tollbooths'));
    }

    public function selectMode(Request $request)
    {

        $this->validate($request, [
            'tollbooth_id' => 'required|exists:tollbooths,id',
            'mode' => 'required|in:0,1'
        ]);

        session()->put('tollbooth_id', $request->input('tollbooth_id'));
        session()->put('mode', $request->input('mode'));


        return redirect('/');
    }

    public function viewClaim(Request $request, $claim_id)
    {
        $claim = Claim::findOrFail($claim_id);
        return view('claim', compact('claim'));
    }

    public function downloadClaim(Request $request, $claim_id)
    {
        $claim = Claim::findOrFail($claim_id);

        $new_line = "\r\n";

        $content = '======================================================' . $new_line;
        $content .= '                        POTVRDA                       ' . $new_line;
        $content .= '======================================================' . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Broj potvrde:', $claim->id) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Naplatna kućica:', $claim->tollbooth->name) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Kategorija vozila:', $claim->category->name) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Broj tablica:', $claim->plates) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Datum: ', $claim->created_at) . $new_line;
        $content .= '======================================================' . $new_line;

        return response()->make($content, '200', array(
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="potvrda-' . $claim->id . '.txt'
        ));
    }

    public function claim(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'plates' => 'required|min:1|max:12'
        ]);

        $claim = new Claim();
        $claim->fill($request->all());
        $claim->user_id = $request->user()->id;
        $claim->tollbooth_id = $request->session()->get('tollbooth_id');
        $claim->save();

        session()->flash('claim', $claim->id);

        return redirect()->back();
    }

    public function viewInvoice(Request $request, $invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        return view('invoice', compact('invoice'));
    }

    public function downloadInvoice(Request $request, $invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);

        $new_line = "\r\n";

        $content = '======================================================' . $new_line;
        $content .= '                        RAČUN                        ' . $new_line;
        $content .= '======================================================' . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Broj računa:', $invoice->id) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Broj potvrde:', $invoice->claim->id) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Ulaz:', $invoice->claim->tollbooth->name) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Izlaz:', $invoice->tollbooth->name) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Kategorija vozila:', $invoice->claim->category->name) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Broj tablica:', $invoice->claim->plates) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Datum ulaska: ', $invoice->claim->created_at) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Datum izlaska: ', $invoice->created_at) . $new_line;
        $content .= mb_sprintf("%-20s %s", 'Cijena: ', $invoice->price) . $new_line;
        if($invoice->has_penalty) {
            $content .= '======================================================' . $new_line;
            $content .= '        !!! VOŽNJA PREKO OGRANIČENJA BRZINE !!!        ' . $new_line;
        }
        $content .= '======================================================' . $new_line;

        return response()->make($content, '200', array(
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="racun-' . $invoice->id . '.txt'
        ));
    }

    public function invoice(Request $request)
    {
        $this->validate($request, [
            'claim_id' => 'required|exists:claims,id|unique:invoices,id'
        ]);

        $claim = Claim::find($request->input('claim_id'));
        $from = $claim->tollbooth_id;
        $to = $request->session()->get('tollbooth_id');

        if($from > $to) {
            $t = $from;
            $from = $to;
            $to = $t;
        }
        $distance = 0;
        if($from == $to) {
            $price = Price::where('category_id', $claim->category_id)->orderBy('value', 'DESC')->first();
        }
        else {
            $price = Price::where('tollbooth1_id', $from)->where('tollbooth2_id', $to)->where('category_id', $claim->category_id)->first();
            $distance = Distance::where('tollbooth1_id', $from)->where('tollbooth2_id', $to)->first();
            if($distance) {
                $distance = $distance->value;
            }
            else {
                $distance = 0;
            }
        }
        $invoice = new Invoice();
        $invoice->fill($request->all());
        $invoice->user_id = $request->user()->id;
        $invoice->tollbooth_id = $request->session()->get('tollbooth_id');
        $invoice->price = $price->value;
        $invoice->save();

        if($distance > 0) {
            $seconds = $invoice->created_at->diffInSeconds($claim->created_at);
            $meters = $distance * 1000;

            $speed = ((double)$meters / $seconds) * 3.6;

            if($speed > config('highway.speed_limit', 130)) {
                $invoice->has_penalty = true;
                $invoice->save();
            }
        }

        session()->flash('invoice', $invoice->id);

        return redirect()->back();
    }
}
