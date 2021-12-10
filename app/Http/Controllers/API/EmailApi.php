<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Mail\TicketGenerated;
use App\Services\ResponseFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailApi extends Controller
{

    /**
     * Class properties
     *
     * @var
     */
    private $model, $emailTemplate;


    /**
     * **create an email message**
     * @return App\Models\Email;
     */
    public function create()
    {
    }


    /**
     * ** Send an email to one or more recipients**
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function send(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => ['required', 'string', 'in:ticket'],
                'id' => ['required', 'string'],
                'recipients.*' => ['required', 'email']
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $validated = $validator->validated();

            $this->determineModelAndTemplate($validated['type'], $validated['id']);

            foreach ($validated['recipients'] as $recipient) {
                Mail::to($recipient)
                    ->send($this->emailTemplate);
            }

            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    private function determineModelAndTemplate($type, $id)
    {
        switch ($type) {
            case 'ticket':
                $this->model = Ticket::where('guid', $id)->first();
                //validate if model exists or is null here
                $this->emailTemplate = new TicketGenerated($this->model);
                break;

            default:
                return null;
                break;
        }
    }
}
