@csrf

<div class="form-group">
    <label for="">Nuevo nombre de usuario:</label>
<input type="text" name="username" value="{{ isset($user) ? $user->username : '' }}"
class="form-control" id="" placeholder="Ingrese el nombre de usuario">
</div>

<div class="form-group">
    <label for="">Nueva contraseña:</label>
<input type="password" name="password"
class="form-control" id="" placeholder="Ingrese la contraseña">
</div>

<div class="form-group">
    <label for="">Nombre:</label>
<input type="text" name="firstname" value="{{ isset($user) ? $user->firstname : '' }}"
class="form-control" id="" placeholder="Ingrese el nombre">
</div>

<div class="form-group">
    <label for="">Apellido:</label>
<input type="text" name="lastname" value="{{ isset($user) ? $user->lastname : '' }}"
class="form-control" id="" placeholder="Ingrese el apellido">
</div>

<div class="form-group">
    <label for="">Email:</label>
<input type="text" name="email" value="{{ isset($user) ? $user->email : '' }}"
class="form-control" id="" placeholder="Ingrese el apellido">
</div>
<br>

<div class="form-group">
    <label for="">Ente / Organismo {{ $entes }}</label>
    <select class="form-select" name="ente_organismo" form="form">
        @if (isset($entes))
            @foreach ($entes as $ente)
                <option value="{{ $ente->id }}"
                @if(isset($user->intitution) && $user->institution==$ente->name)

                    selected

                @endif
                >{{ $ente->name }}</option>
            @endforeach
        @endif
    </select>
</div>



