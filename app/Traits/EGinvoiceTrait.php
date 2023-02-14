<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

trait EGinvoiceTrait
{
    function submitDocuments($body,$auth){

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization'=>$auth
        ];
        $request = new Request('POST', 'https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }
    function submitDocumentsCredit($body,$auth){
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization'=>$auth

        ];
        $request = new Request('POST', 'https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }
    function submitDocumentsDepit($body,$auth){
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization'=>$auth

        ];
        $request = new Request('POST', 'https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions',$headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

    }
    function cancelDocument($documentUUID,$reason,$auth){
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization'=>$auth
        ];
        $body = '{
            "status": "cancelled",
            "reason": '.$reason.'
        }';
        $request = new Request('PUT', 'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/documents/state/'.$documentUUID.'/state', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }
    function rejectDocument($documentUUID,$reason,$auth){
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization'=>$auth
        ];
        $body = '{
            "status": "rejected",
            "reason": '.$reason.'
        }';
        $request = new Request('PUT', 'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/documents/state/'.$documentUUID.'/state', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }
    function getRecentDocuments(){

    }
    function requestDocumentPackage(){

    }
}
