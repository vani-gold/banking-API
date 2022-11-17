<?php

namespace App\Http\Controllers\V1;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Resources\V1\AccountResource;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ::where('user_id', $request->user()->id)
        // return Account::all();  //get all
        return AccountResource::collection(Account::paginate());
        // return AccountResource::collection(Account::where('user_id', $request->user()->id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $account = Account::create($request->all());

        // return $account;  //create an account
        return new AccountResource($account);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return $account; //get 1
        // return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update($request->all());
        // return $account;  
        return new AccountResource($account);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response('', 204);
    }
}
