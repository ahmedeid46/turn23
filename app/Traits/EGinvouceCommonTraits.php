<?php

namespace App\Traits;

use HTTP_Request2;
use HTTP_Request2_Exception;

trait EGinvouceCommonTraits
{
    function login(){
        $request = new HTTP_Request2();
        $request->setUrl('https://id.preprod.eta.gov.eg/connect/token');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Content-Type' => 'application/x-www-form-urlencoded',
            '' => ''
        ));
        $request->addPostParameter(array(
            'grant_type' => 'client_credentials',
            'client_id' => config('client_id'),
            'client_secret' => config('client_secret'),
            'scope' => 'InvoicingAPI'
        ));
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                return $response->getBody();
            }
            else {
                return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                    $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function getDocumentsType($creditupdated,$CreditEn,$CreditAr,$DesCreditEn,$DesCreditAr,$activeFrom){

        $request = new HTTP_Request2();
        $request->setUrl('https://api.preprod.invoicing.eta.gov.eg/api/v1/documenttypes');
        $request->setMethod(HTTP_Request2::METHOD_GET);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Accept-Language' => 'ar'
        ));
        $request->setBody('{
\n    "documentTypeCodeName": '.$creditupdated.',
\n    "namePrimaryLang": '.$CreditEn.',
\n    "nameSecondaryLang": '.$CreditAr.',
\n    "descriptionPrimaryLang": '.$DesCreditEn.',
\n    "descriptionSecondaryLang": '.$DesCreditEn.',
\n    "activeFrom": '.$activeFrom.'
\n}');
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                return $response->getBody();
            } else {
                return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                    $response->getReasonPhrase();
            }
        } catch (HTTP_Request2_Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function getDocumentType($documentID){
        $request = new HTTP_Request2();
        $request->setUrl('https://api.preprod.invoicing.eta.gov.eg/api/v1/documenttypes/'.$documentID);
        $request->setMethod(HTTP_Request2::METHOD_GET);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array());
        $request->setBody('');
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                return $response->getBody();
            } else {
                return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                    $response->getReasonPhrase();
            }
        } catch (HTTP_Request2_Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function getDocumentTypeVersion($documentTypeID,$documentTypeVersionID){
        $request = new HTTP_Request2();
        $request->setUrl('https://api.preprod.invoicing.eta.gov.eg/api/v1/documenttypes/'.$documentTypeID.'/versions/'.$documentTypeVersionID);
        $request->setMethod(HTTP_Request2::METHOD_GET);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Accept-Language' => 'ar'
        ));
        $request->setBody('');
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                echo $response->getBody();
            }
            else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                    $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function getNotification($pageSize = 10,$pageNo = 1,$dateFrom,$dateTo,$type,$lang='en',$status,$channel){
        $request = new HTTP_Request2();
        $request->setUrl('https://api.preprod.invoicing.eta.gov.eg/api/v1/notifications/taxpayer?pageSize='.$pageSize.'&pageNo='.$pageNo.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo.'&type='.$type.'&language='.$lang.'&status='.$status.'&channel='.$channel);
        $request->setMethod(HTTP_Request2::METHOD_GET);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                echo $response->getBody();
            }
            else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                    $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
