<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EmailSubmission;
use App\Models\EmailSubmissionField;
use App\Models\EmailSubmissionRecipiant;

class EmailSubmissionController extends Controller
{
	// Get all submissions
	public function authenticate(Request $request){
		$request->validate([
			'name' => 'string|nullable'
		]);

		$query = EmailSubmission::query();

		if ($request->has('name')) {
			$query->where('name', 'like', $request->name);
		}

		$emailSubmissions = $query->get();

		return Response([
			'message' => 'List of email_submissions.',
			'email_submissions' => $emailSubmissions
		], 200);
	}

	// Get individual submission + relations

	// Create subbmission

	// update submission

	// delete submission and relations

	// add field

	// remove field

	// add recipiant

	// remove recipiant

	// Public submit
}
