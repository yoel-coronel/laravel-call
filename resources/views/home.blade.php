@extends('layouts.app')
@section('content')
    <template v-if="menu==0">
            <maps-component></maps-component>
    </template>
    <template v-if="menu==1">
            <kardex></kardex>
    </template>
    
@endsection
