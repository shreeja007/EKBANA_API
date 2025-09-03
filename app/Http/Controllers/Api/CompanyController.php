<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('category')->paginate(10);
        return $this->successResponse(
            CompanyResource::collection($companies)->response()->getData(true),
            'Company Fetched Successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        $company = Company::create($data);

        return $this->successResponse(
            new CompanyResource($company->load('category')),
            'Company Created Successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return $this->successResponse(new CompanyResource($company->load('category')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($company->image && Storage::disk('public')->exists($company->image)) {
                Storage::disk('public')->delete($company->image);
            }
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        $company->update($data);

        return $this->successResponse(
            new CompanyResource($company->load('category')),
            'Company Updated Successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {

        if ($company->image && Storage::disk('public')->exists($company->image)) {
            Storage::disk('public')->delete($company->image);
        }

        $company->delete();

        return $this->successResponse(null, 'Company Deleted Successfully.');
    }
}
