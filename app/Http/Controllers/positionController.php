<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeArea;
use App\Models\EmployeeFunction;
use App\Models\EmployeePosition;
use App\Models\EmployeeRole;
use Illuminate\Http\Request;

class positionController extends Controller
{

    public function positionEmployee()
    {
        $positionE = EmployeeFunction::with(['employee', 'supervisor', 'area', 'position', 'role'])->where('employee_role_id', '!=', 1)->where('state', 1)
            ->get();

        return view('position.positionL', ['positions' => $positionE]);
    }

    public function positionR()
    {
        $functions = EmployeeFunction::all();

        if ($functions->isEmpty()) {
            $usersC = Employee::all();
            $area = EmployeeArea::where('id', 1)->get();
            $position = EmployeePosition::where('id', 1)->get();
            $role = EmployeeRole::where('id', 1)->get();
        } else if ($functions) {
            $usersC = Employee::whereNull('rol_id')->get();
            $area = EmployeeArea::where('id', '!=', 1)->get();
            $position = EmployeePosition::where('id', '!=', 1)->get();
            $role = EmployeeRole::where('id', '!=', 1)->get();
        }

        $usersB = Employee::all();

        return view('position.positionR', [
            'areas' => $area,
            'positions' => $position,
            'roles' => $role,
            'usersC' => $usersC,
            'usersB' => $usersB
        ]);
    }

    public function validateArea($areaId, $roleId)
    {
        $positions = EmployeePosition::where('employee_area_id', $areaId)
            ->where('employee_rol_id', $roleId)
            ->get();

        return response()->json($positions);
    }




    public function registerPosition(Request $request)
    {
        $request->validate([
            'nameE' => 'required|exists:employees,id',
            'area' => 'required|exists:employee_areas,id',
            'position' => 'required|exists:employee_positions,id',
            'role' => 'required|exists:employee_roles,id',
            'boss' => 'required|exists:employees,id',
        ]);

        $functions = EmployeeFunction::all();

        if (!$functions->isEmpty()) {
            if ($request->nameE == $request->boss) {
                return back()->with('alerta', [
                    'titulo' => '¡Atención!',
                    'mensaje' => 'No puede asignar como Jefe al mismo Colaborador.',
                    'icono' => 'warning',
                    'confirmarTexto' => 'Entendido',
                    'mostrarCancelar' => false
                ]);
            }
        }

        EmployeeFunction::create([
            'employee_id' => $request->nameE,
            'employee_area_id' => $request->area,
            'employee_position_id' => $request->position,
            'employee_role_id' => $request->role,
            'supervisor_id' => $request->boss,
        ]);

        $employee = Employee::find($request->nameE);
        $employee->update(['rol_id' => $request->role]);

        return redirect()->route('positionList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Cargo Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function searchPositionE($id)
    {
        $cargos = EmployeeFunction::with(['employee', 'supervisor', 'area', 'position', 'role'])
            ->where('id', $id)
            ->firstOrFail();

        $areas = EmployeeArea::where('id', '!=', 1)->get();
        $positions = EmployeePosition::where('id', '!=', 1)->get();
        $roles = EmployeeRole::where('id', '!=', 1)->get();

        $usersC = Employee::all();
        $usersB = Employee::where('id', '!=', $cargos->employee_id)->get();

        return view('position.positionE', [
            'cargos' => $cargos,
            'areas' => $areas,
            'positions' => $positions,
            'roles' => $roles,
            'usersC' => $usersC,
            'usersB' => $usersB
        ]);
    }

    public function editPosition(Request $request, $id){

        $request->validate([
            'area' => 'required|exists:employee_areas,id',
            'position' => 'required|exists:employee_positions,id',
            'role' => 'required|exists:employee_roles,id',
            'boss' => 'required|exists:employees,id',
        ]);

        $employeePos = EmployeeFunction::findOrFail($id);

        $employeePos->update([
            'employee_area_id' => $request->area,
            'employee_position_id' => $request->position,
            'employee_role_id' => $request->role,
            'supervisor_id' => $request->boss,
        ]);

        return redirect()->route('positionList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Usuario Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function deletePosition($id)
    {

        $employeePos = EmployeeFunction::find($id);
        $employeePos->update(['state' => 2]);

        return redirect()->route('positionList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Cargo Eliminado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}
