<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmailSubmission;

class EmailSubmissionField extends Model
{
    use HasFactory;

    protected $table = 'email_submission_fields';

	protected $fillable = [
		'email_submission_id',
		'name'
	];

	public function emailSubmission(){
		return $this->belongsTo(EmailSubmission::class, 'email_submission_id', 'id');
	}
}
