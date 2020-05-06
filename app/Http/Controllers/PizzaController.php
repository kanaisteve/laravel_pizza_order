<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class PizzaController extends Controller
{
    // use this method if want to protect every single route
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index() {
        // variables
        $name = request('name');
        $age = request('age');

        // ****** get data from multidimentional array ***********
        // $pizzas = [
        //     ['type' => 'hawaiian', 'base' => 'cheesy crust', 'price' => '10'],
        //     ['type' => 'volcano', 'base' => 'garlic crust', 'price' => '34'],
        //     ['type' => 'veg supreme', 'base' => 'thin & crispy', 'price' => '42',]
        // ];

        // ********* get data from database  *************
        $pizzas = Pizza::all();
        //$pizzas = Pizza::orderBy('name', 'desc')->get();
        //$pizzas = Pizza::where('type', 'hawaiian')->get();
        //$pizzas = Pizza::latest()->get();

        // this controller lists all the pizzas on the screen from the pizzas_table
        return view('pizzas.index',  [
            'pizzas' => $pizzas,
            'name' => $name,
            'age' => $age
        ]);
    }

    public function show($id) {
        // use the $id variable to query the db for a single record and inject that record into the show view
        $pizza = Pizza::findOrFail($id);

        return view('pizzas.show',  [
            'pizza' => $pizza,
        ]);
    }

    public function create() {
        return view('pizzas.create');
    }

    public function store() {

        $pizza = new Pizza(); // inherit all the methods available to the developer to interact with the database [save() is one method.]

        $pizza->name =  request('name'); // how to access data (the name input) and storing it in a variable.
        $pizza->type = request('type'); 
        $pizza->base = request('base'); 
        $pizza->toppings = request('toppings');

        error_log($pizza);
        $pizza->save(); // taking an instance of the Pizza model and saving it in the database (an instance  meaning you have access to the methods)

        return redirect('/')->with('mssg', 'Thanks for ordering!'); // redirects to the welcom page with a message
        //return request('toppings');
    }

    public function destory($id) {
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return redirect('/pizzas'); // redirects to the pizza listings
    }
}
