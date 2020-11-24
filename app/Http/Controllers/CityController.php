<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\rental\Gateways\BackendGateway;
use App\rental\Interfaces\BackendRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * CityController constructor.
     */
    public function __construct(BackendGateway $backendGateway, BackendRepositoryInterface $backendRepository)
    {
        $this->middleware('CheckAdmin');

        $this->bG = $backendGateway;
        $this->bR = $backendRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //zwraca wszystkie miasta
        return view('backend.cities.index', ['cities'=>$this->bR->getAllCities()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //walidacja formularza - w bG - logika biznesowa/walidacja formularzy
        $this->bG->createNewCity($request);

        return redirect()->route('cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //szczegoly dot. miasta
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('backend.cities.edit', ['city'=>$this->bR->getCity($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //walidacja formularza - w bG - logika biznesowa/walidacja formularzy
        $this->bG->updateCity($request, $id);

        return redirect()->route('cities.index')->with('message', 'Zaktualizowano nazwę miasta.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bR->deleteCity($id);

        return redirect()->route('cities.index')->with('message', 'Usunięto miasto.');
    }
}
