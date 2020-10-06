<?php

namespace App\Response;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Log;

trait CustomRenderer {
  /**
   * Default status code
   */
  protected $statusCode = IlluminateResponse::HTTP_OK;

  public function getStatusCode()
  {
      return $this->statusCode;
  }

  public function setStatusCode($statusCode)
  {
      $this->statusCode = $statusCode;
  }

  public function respond($data)
  {
      return response()->json($data, $this->getStatusCode());
  }

  public function baseSuccessRespond($message, $status = 'success', $payload = [], $errors = [])
  {
      $data = array(
          'status' => $status,
          'message' => $message,
          'status_code' => $this->getStatusCode(),
      );
      if ($status === 'fail' && count($errors)) {
          $data = array_merge(['errors' => $errors], $data);
      } else {
        $data['data'] = $payload;
      }
      return $this->respond($data);
  }

  public function baseCreateResponse($message = 'Item created', $payload = [])
  { 
        $status = 'success';
        $this->setStatusCode(IlluminateResponse::HTTP_CREATED);
        return $this->baseSuccessRespond($message, $status, $payload);
  }
  
  public function baseRetrieveResponse($message = 'Successfully retrieved', $payload = [])
  { 
        $status = 'success';
        $this->setStatusCode(IlluminateResponse::HTTP_OK);
        return $this->baseSuccessRespond($message, $status, $payload);
  }

  public function baseUpdateResponse($message = 'Item updated', $payload = [])
  { 
        $status = 'success';
        $this->setStatusCode(IlluminateResponse::HTTP_OK);
        return $this->baseSuccessRespond($message, $status, $payload);
  }

  public function baseDeleteResponse($message = 'Item Deleted', $payload = [])
  { 
        $status = 'success';
        $this->setStatusCode(IlluminateResponse::HTTP_OK);
        return $this->baseSuccessRespond($message, $status, $payload);
  }
}
