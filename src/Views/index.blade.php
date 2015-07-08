@if(auth()->check())

    <div id="socieboy">

        <input type="hidden" id="auth" value="{{ auth()->user()->id }}">

        <component is="@{{ viewChat }}"></component>

    </div>

@endif


