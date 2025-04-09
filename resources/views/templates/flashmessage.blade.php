@if(session()->has('success'))
<div class="alert alert-success text-center fsz-12">{{ session()->get('success') }}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger text-center fsz-12">{{ session()->get('error') }}</div>
@endif 