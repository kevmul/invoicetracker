@extends('layout.master')

@section('content')
    <main class="main">
        <div class="side-background left"></div>
        <div class="container">
            <div class="duo reversed">
                <div class="lead p-t-50"><router-view></router-view></div>
                <aside class="menu p-t-50 p-r-25">
                    <div class="logo"><router-link :to="{path : '/'}">Logo</router-link></div>
                    <p class="menu-label">Clients</p>
                        <clients></clients>
                    <ul class="menu-list">
                    </ul>
                    <v-button text="Add Client" component="AddClientModal"></v-button>
                </aside>
            </div>
        </div>
    </main>
@endsection
