<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\Package\IPackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $packageService;

    public function __construct(IPackageService $packageService)
    {
        $this->packageService = $packageService;
    }


    public function index()
    {
        $packages = $this->packageService->getAllPackages();

        return view('website.package', compact('packages'));
    }

    public function details($id)
    {
        $package = $this->packageService->getPackageWithMeals($id);

        return view('website.partials.package_modal', compact('package'));
    }
}
