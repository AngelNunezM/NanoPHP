<?php 

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Models\Client;
use App\Services\ClientService;
use Exception;

class ClientController {
    
    use HTTP;

    private ClientService $clientService;

    public function __construct(){
        $this->clientService = new ClientService();
    }

    public function index()
    {
        Authentication::verify();
        try {
             $data = $this->clientService->getAllClients();

            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "data" => $data,
                ]);
            } else {
                View::render("clients/Clients", [
                    "clients" => $data
                ]);
            }
            
        } catch (Exception $ex){
            if($this->isJsonRequest()){
                $this->response([
                    "success" => false,
                    "message" => $ex->getMessage()
                ], 500);
            }

        }
    }

    public function create()
    {
        Authentication::verify();
        $request = $this->request();

        try {
            $client = new Client();
            $client->name_company = $request['name_company'];
            $client->name_contact = $request['name_contact'];
            $client->phone_contact = $request['phone_contact'];
            $client->email_contact = $request['email_contact'] ?? null;

            $data = $this->clientService->createClient($client);
            
            $this->response([
                "success" => true,
                "data" => $data
            ]);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], $ex->getCode());
        }
    }

    public function update($clientId)
    {
        Authentication::verify();
        $request = $this->request();

        try {
            $client = new Client();
            $client->id = $clientId;
            $client->name_company = $request['name_company'];
            $client->name_contact = $request['name_contact'];
            $client->phone_contact = $request['phone_contact'];
            $client->email_contact = $request['email_contact'] ?? null;

            $data = $this->clientService->updateClient($client); 
            
            $this->response([
                "success" => true,
                "data" => $data
            ]);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], $ex->getCode());
        }
    }

    public function changeStatus($clientId)
    {
        Authentication::verify();
        try {
            $data = $this->clientService->changeStatusClient($clientId);
            
            $this->response([
                "success" => true,
                "data" => $data
            ]);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }
}