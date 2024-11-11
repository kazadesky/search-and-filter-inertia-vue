<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where("name", "LIKE", "%" . $search . "%")
                    ->orWhere("email", "LIKE", "%" . $search . "%");
            })
            ->orderBy("name", "asc")
            ->paginate(15)
            ->withQueryString();

        return Inertia::render("User/Index", [
            "users" => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
