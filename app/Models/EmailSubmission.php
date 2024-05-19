<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmailSubmissionField;
use App\Models\EmailSubmissionRecipiant;

class EmailSubmission extends Model
{
	use HasFactory;

	protected $table = 'email_submissions';

	protected $fillable = [
		'name',
		'origin',
		'turnstile_enable',
		'turnstile_secret'
	];

	public function fields(){
		return $this->hasMany(EmailSubmissionField::class, 'email_submission_id', 'id');
	}

	public function recipiants(){
		return $this->hasMany(EmailSubmissionRecipiant::class, 'email_submission_id', 'id');
	}

	public function logs(){
		return $this->hasMany(EmailSubmissionLog::class, 'email_submission_id', 'id');
	}
}
