<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _nuevo_usuario($data)
    {
        try
        {
            //@$data son los datos empaquetados enviados desde el controller.
            //Leyendo en caso que exista un registro ya existente bajo 2 aspectos
            $consulta_user = $this->db->get_where('usuarios',['usuario'=>$data['usuario']]);
            $consulta_email = $this->db->get_where('usuarios',['correo'=>$data['correo']]);
            //Consultando si hay existencias en estas querys
            if($consulta_user->result())
                $mensaje = 1; //Usuario en uso
            elseif($consulta_email->result())
                $mensaje = 2; //email en uso
            elseif($data['nombre']==''||$data['correo']==''||$data['usuario']==''||$data['password']=='')
                $mensaje = 4; //formuario incompleto
            else 
            {
                $contrahash=password_hash($data['password'],PASSWORD_DEFAULT);
                //Un pw hasheado así se verifica con password_verify($password, $hashed_password)
                $this->db->insert('usuarios',[
                    'nombre'=>$data['nombre'],
                    'correo'=>$data['correo'],
                    'usuario'=>$data['usuario'],
                    'password'=>$contrahash,
                    'rol'=>2,
                    'date'=>date('d-m-Y H:i:s'),
                    ]);
                $mensaje = 0; //Retorno exitoso
            }
            return $mensaje;
        }
        catch(Exception $e)
        {
            $mensaje = 3; //Error manejado por try-catch
            print_r($e);
            return $mensaje;
        }
    }

    public function nuevo_usuario($d)
    {
        return $this->_nuevo_usuario($d);
    }

    private function _ingreso_usuario($identificador)
    {
        //Revalidando.... campos no vacíos
        if($identificador['usuario'] == '' || $identificador['password'] == '')
            {
                $this->session->unset_userdata('user_data');
                $mensaje = false; //Formulario vacío
            }
        else 
        {
            $query = $this->db->get_where('usuarios',['usuario'=>$identificador['usuario']]);
            if(!$query->result())
            {
                $this->session->unset_userdata('user_data');
                $mensaje = false; 
            }   
            else 
            {
                $mensaje = password_verify($identificador['password'],$query->row()->password); //dará true si la pw coincide
                if(!$mensaje)
                    $this->session->unset_userdata('user_data');
                else
                {
                    $token2 = crypt($identificador['token2']);
                    $row=$query->row();
                    //Guardamos el token con un update
                    $this->db->where('usuario',$row->usuario);
                    $this->db->update('usuarios',['remember_token'=>$token2]);
                    //Para generar los datos del login
                    $data=['user_data'=>[
                        'id'=>$row->idusuarios,
                        'nombre'=>$row->nombre,
                        'correo'=>$row->correo,
                        'usuario'=>$row->usuario,
                        'rol'=>$row->rol,
                        'remember_token'=>$token2]
                    ];
                    $this->session->set_userdata($data);
                }
            }      
        }
        return $mensaje;
    }

    public function ingreso_usuario($credencial)
    {
        return $this->_ingreso_usuario($credencial);
    }

    private function _consultaToken($id)
    {
        //Hacemos la query
        $query = $this->db->get_where('usuarios',['idusuarios'=>$id]);
        //Pedimos la fila
        $row = $query->row();
        //Se retorna el remember token
        return $row->remember_token;
    }

    public function consultaToken($a)
    {
        return $this->_consultaToken($a);
    }
}