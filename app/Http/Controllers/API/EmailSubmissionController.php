<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Exception;

use App\Mail\Submission;

use App\Models\EmailSubmission;
use App\Models\EmailSubmissionField;
use App\Models\EmailSubmissionRecipiant;
use GuzzleHttp\Psr7\Response;

class EmailSubmissionController extends Controller
{
	// Get all submissions
	public function index(Request $request){
		$request->validate([
			'name' => 'string|nullable'
		]);

		$query = EmailSubmission::query();

		if ($request->filled('name')) {
			$query->where('name', 'like', "%{$request->name}%");
		}

		$emailSubmissions = $query->get();

		return Response([
			'message' => 'List of email_submissions.',
			'email_submissions' => $emailSubmissions
		], 200);
	}

	// Get individual submission + relations
	public function show(EmailSubmission $emailSubmission){

		$emailSubmission = EmailSubmission::where('id', $emailSubmission->id)->with(['fields', 'recipiants'])->first();

		return Response([
			'message' => 'Single email_submissions.',
			'email_submission' => $emailSubmission
		], 200);
	}

	// Create subbmission
	public function store(Request $request){
		$request->validate([
			'name' => 'string|required',
			'origin' => 'string|required'
		]);

		$newEmailSubmission = EmailSubmission::create([
			'name' => Str::slug($request->name, '-'),
			'origin' => $request->origin
		]);

		return Response([
			'message' => 'New email_submission created.',
			'email_submission' => $newEmailSubmission
		], 200);
	}

	// update submission
	public function update(Request $request, EmailSubmission $emailSubmission){
		$request->validate([
			'name' => 'string|nullable',
			'origin' => 'string|nullable'
		]);

		if ($request->filled('name')) {
			$emailSubmission->name = Str::slug($request->name, '-');
		}

		if ($request->filled('name')) {
			$emailSubmission->origin = $request->origin;
		}

		$emailSubmission->save();

		return Response([
			'req' => $request->getContent(),
			'message' => 'Updated email_submission.',
			'email_submission' => $emailSubmission
		], 200);
	}

	// delete submission and relations
	public function detroy(EmailSubmission $emailSubmission){

		$emailSubmission->delete();

		return Response([
			'message' => 'Removed email_submission.'
		], 200);
	}

	// add field
	public function addField(Request $request, EmailSubmission $emailSubmission){
		$request->validate([
			'name' => 'string|required'
		]);

		$newEmailSubmissionField = EmailSubmissionField::create([
			'email_submission_id' => $emailSubmission->id,
			'name' => Str::slug($request->name, '-'),
		]);

		return Response([
			'message' => 'New field created.',
			'email_submission' => $emailSubmission,
			'new_field' => $newEmailSubmissionField
		], 200);
	}

	// remove field
	public function removeField(Request $request, EmailSubmission $emailSubmission, EmailSubmissionField $field){

		if($field->email_submission_id != $emailSubmission->id){
			return Response([
				'message' => 'Field does not match submission record.'
			], 400);
		}

		$field->delete();

		return Response([
			'message' => 'Field removed from email_submission.'
		], 200);
	}

	// add recipiant
	public function addRecipiant(Request $request, EmailSubmission $emailSubmission){
		$request->validate([
			'email' => 'string|required'
		]);

		$newEmailSubmissionRecipiant = EmailSubmissionRecipiant::create([
			'email_submission_id' => $emailSubmission->id,
			'email' => $request->email
		]);

		return Response([
			'message' => 'New recipiant added to submission.',
			'email_submission' => $emailSubmission,
			'new_recipiant' => $newEmailSubmissionRecipiant
		], 200);
	}

	// remove recipiant
	public function removeRecipiant(Request $request, EmailSubmission $emailSubmission, EmailSubmissionRecipiant $recipiant){

		if($recipiant->email_submission_id != $emailSubmission->id){
			return Response([
				'message' => 'Recipiant does not match submission record.'
			], 400);
		}

		$recipiant->delete();

		return Response([
			'message' => 'Recipiant removed from email_submission.'
		], 200);
	}

	// Public submit
	public function submit(Request $request, string $email_submission_name){
		try {

      $emailSubmission = EmailSubmission::with(['fields', 'recipiants'])->where('name', $email_submission_name)->first();

			if(!$emailSubmission){
				return Response([
					'message' => 'No matching form submission.'
				], 404);
			}

			if($request->host() != $emailSubmission->origin){
				return Response([
					'message' => 'Form submission cannot occur from this origin.',
					'origin' => $request->host()
				], 401);
			}

      $formSubmissionObj = [];

      foreach ($emailSubmission->fields as $field) {
        $formSubmissionObj[$field->name] = $request[$field->name];
      }

      foreach ($emailSubmission->recipiants as $recipient) {
				Mail::to($recipient)->send(new Submission($emailSubmission, $formSubmissionObj));
      }

      return response([
        'message' => 'Email submission recieved.'
      ], 200);

    } catch (Exception $e) {
      return response([
        'message' => $e->getMessage()
      ], 500);
    }
	}
}
