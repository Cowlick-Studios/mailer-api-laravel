<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmailSubmission;

class EmailSubmissionRecipiant extends Model
{
    use HasFactory;

    protected $table = 'email_submission_recipiants';

	protected $fillable = [
		'email_submission_id',
		'email'
	];

    public function emailSubmission(){
		return $this->belongsTo(EmailSubmission::class, 'email_submission_id', 'id');
	}
}
