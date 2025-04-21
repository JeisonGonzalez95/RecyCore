<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\EmployeeArea;
use App\Models\EmployeeRole;
use App\Models\users_app;
use Illuminate\Http\Request;

class employeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function employeeR()
    {
        $roles = EmployeeRole::all();
        $areas = EmployeeArea::all();

        return view('employees.employeesR', compact('roles', 'areas'));
    }

    public function registerEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'dni' => 'required|numeric|min:5',
            'email' => 'required|min:3',
            'phone' => 'required|min:8',
            'username' => 'required|min:4',
            'pass' => 'required|min:5',
            'rol' => 'required',
            'area' => 'required',
        ]);

        $usersV = Employee::find($request->dni);

        if (empty($usersV)) {

            Employee::create([
                'fullname' => $request->name,
                'dni' => $request->dni,
                'email' => $request->email,
                'phone' => $request->phone,
                'rol_id' => $request->rol,
                'area_id' => $request->area
            ]);

            users_app::create([
                'fullname' => $request->name,
                'dni' => $request->dni,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->pass),
                'remember_token' => $request->_token
            ]);

            return redirect()->route('employeesList')->with('alerta', [
                'titulo' => '¡Éxito!',
                'mensaje' => 'Usuario Creado correctamente.',
                'icono' => 'success',
                'confirmarTexto' => 'Entendido',
                'mostrarCancelar' => false
            ]);
        } else {
            return redirect()->route('employeesList')->with('alerta', [
                'titulo' => 'Atención',
                'mensaje' => 'El usuario que esta creando ya se encuentra registrado con ese documento.',
                'icono' => 'warning',
                'confirmarTexto' => 'Entendido',
                'mostrarCancelar' => false
            ]);
        }
    }

    public function searchEmployee()
    {
        $employees = Employee::with(['rol', 'area', 'userApp'])->get();
        return view('employees.employeesL', compact('employees'));
    }


    public function searchEmployeeE($id)
    {
        $employee = Employee::findOrFail($id);
        $roles = EmployeeRole::all();
        $areas = EmployeeArea::all();
        return view('employees.employeesE', compact('employee', 'roles', 'areas'));
    }

    public function editEmployee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'dni' => 'required|numeric|unique:employees,dni,' . $id,
            'phone' => 'required|min:8',
            'email' => 'required|min:3',
            'rol_e' => 'required',
            'area_e' => 'required',
        ]);

        $employee = Employee::findOrFail($id);

        $employee->update([
            'fullname' => $request->name,
            'dni' => $request->dni,
            'phone' => $request->phone,
            'email' => $request->email,
            'rol_id' => $request->rol_e,
            'area_id' => $request->area_e,
        ]);

        return redirect()->route('employeesList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Usuario Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function deleteEmployee($id)
    {

        $employee = Employee::find($id);

        $newState = $employee->state == 1 ? 0 : 1;

        $employee->update([
            'state' => $newState,
            'updated_at' => now()
        ]);

        $accion = $newState == 1 ? 'Activado' : 'Desactivado';

        return redirect()->route('employeesList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => "Usuario $accion correctamente.",
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editUser(Request $request)
    {
        $request->validate([
            'pass_er' => 'required|min:3'
        ]);

        $user = users_app::findOrFail($request->user_id);

        $user->update([
            'password' => $request->pass_er,
            'updated_at' => now()
        ]);

        return redirect()->route('employeesList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Usuario Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}
