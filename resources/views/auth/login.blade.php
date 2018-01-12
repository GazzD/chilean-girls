@extends('templates.frontend.master.index')

@section('content')

<div class="" style="border: 1px solid #ddd;">
    <div class="main4">
        <div class="formulario">
            <div id="parte"><h3>Iniciar sesión</h3></div>
            {!!Form::open(array('files' => true, 'id' => 'loginForm', 'route' =>'flogin')) !!}
                <div class="contenedor-imputs">
                    <label>Correo electrónico*</label>
                    {!! Form::text('email', null, array('id' => 'email', 'class' => 'contact-input', 'placeholder' => 'Correo electrónico')) !!}
                    <div class="right-light">{!! $errors->first('email') !!}</div>
                    <label>Contraseña</label>
                    {!! Form::password('password', null, array('id' => 'password', 'class' => 'contact-input', 'placeholder' => 'Contraseña')) !!}
                    <div class="right-light">{!! $errors->first('portfolio') !!}</div>
                    <label>
                        <input type="checkbox" name="remember" {!! old('remember') ? 'checked' : '' !!}> Recordarme
                    </label>
                    <button type="submit" class="btn btn-primary">
                        Iniciar sesión
                    </button>
                    
                    <a class="btn btn-link" href="{!! route('password.request') !!}">
                        ¿Olvidó su contraseña?
                    </a>
                </div>
                
            {!!Form::close()!!}
        </div>
        
    </div>
</div>

@endsection
