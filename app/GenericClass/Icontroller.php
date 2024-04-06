<?php
namespace App\GenericClass;
use Illuminate\Http\Request;
interface IController {
    public function get(Request $response);
    public function update(Request $response);
    public function delete(Request $response);
    public function getAll();
}