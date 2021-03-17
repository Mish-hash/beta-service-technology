@extends('layouts.app')

@section('content')
<div class="container">
    @include('includes.result_messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Curencies') }}</div>

                <div class="card-body">
                    <form action="/home" method="GET">

                        {{-- @csrf --}}

                        <div class="form-group row">

                            <div class="col-sm-6">
                                <label for="date-from">Date-from</label>
                                <input type="date" class="form-control" name="from" id="date-from" value="{{$reqDate}}">
                            </div>

                            <div class="col-sm-6">
                                <label for="date-from">Date-to</label>
                                <input type="date" class="form-control" name="to" id="date-to" value="{{$reqDate}}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select curency</label>
                            <select multiple class="form-control" id="curencies" name="charCode[]">
                                @foreach ($curenciesCharCode as $curency)
                                    <option>{{$curency->charCode}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Get curencies</button>

                    </form>

                    @if (isset($curencies))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">valuteID</th>
                                    <th scope="col">numCode</th>
                                    <th scope="col">charCode</th>
                                    <th scope="col">name</th>
                                    <th scope="col">value</th>
                                    <th scope="col">date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($curencies as $curency)
                                    <tr>
                                        <td>{{$curency->valuteID}}</td>
                                        <td>{{$curency->numCode}}</td>
                                        <td>{{$curency->charCode}}</td>
                                        <td>{{$curency->name}}</td>
                                        <td>{{$curency->value}}</td>
                                        <td>{{$curency->date}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
