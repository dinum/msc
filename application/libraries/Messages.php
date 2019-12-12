<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Messages
 *
 * @author admin
 */
class Messages {
        
    public function returnMessage($id){
        $CI =& get_instance();
        
        switch ($id) {
            case 1:
                return "<div class='alert alert-success'>Successfully Updated</div>";
                break;
            
            case 2:
                return "<div class='alert alert-danger'>Error in Update</div>";
                break;
            
            case 3:
                return "<div class='alert alert-danger'>Error in Delete</div>";
                break;
            
            case 4:
                return "<div class='alert alert-success'>Successfully Deleted</div>";
                break;
            case 5:
                return "<div class='alert alert-success'>Successfully Added</div>";
                break;
            case 6:
                return "<div class='alert alert-danger'>Error in Adding Data</div>";
                break; 
            
            case 7:
                return "<div class='alert alert-danger'>Error in Uploading Image.for more info,check log</div>";
                break;
            
            case 8:
                return "<div class='alert alert-success'>Wellcome to ".$CI->session->userdata('company_name').". Administration Panel</div>";
                break;
            case 9:
                return "<div class='alert alert-danger'>Invalid Selection</div>";
                break;
            case 10:
                return "<div class='alert alert-danger' role='alert'>Invalid User Name or Password</div>";
                break;
            
            default:
                return "<div class='alert alert-warning'>Unknown Error, Please Contact Administrator</div>";
                break;
        }
    }
}
