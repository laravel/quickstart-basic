<!--resources/views/tasks.blade.php-->


@extends('layouts.app')
{{--使用定義於 resources/views/layouts/app.blade.php 的佈局--}}

@section('content')
    {{--注入到 app.blade.php 佈局中的 yield('content') 位置--}}


    <!-- Bootstrap 樣板... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            新任務
        </div>
        <div class="panel-body">
            <!-- 顯示驗證錯誤 -->
        @include('common.errors')
        {{--載入位於 resources/views/common/errors.blade.php 的模板--}}

        <!-- 新任務的表單 -->
            <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- 任務名稱 -->
                <div class="form-group">
                    <label for="task" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                </div>

                <!-- 增加任務按鈕-->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-plus"></i> 增加任務
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- 目前任務 -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                目前任務
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- 表頭 -->
                    <thead>
                    <tr>
                        <th>Task</th>
                    </tr>
                    </thead>

                    <!-- 表身 -->
                    <tbody>

                    {{--撰寫簡潔的迴圈，並編譯成快速的純 PHP 程式碼--}}
                    @foreach ($tasks as $task)

                        <tr>
                            <!-- 任務名稱 -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <!-- 刪除按鈕 -->
                            <td>

                                {{--方法欺騙的註記--}}

                                {{--
                                注意，刪除按鈕的表單 method 被列為 POST，
                                即使我們回應的請求使用了 Route::delete 路由。

                                HTML 表單只允許 GET 及 POST HTTP 動詞，

                                所以我們需要有個方式在表單假冒一個 DELETE 請求。--}}

                                {{--

                                我們可以在表單中透過
                                method_field('DELETE')
                                函式輸出的結果假冒一個 DELETE 請求。
                                此函式會產生一個隱藏的表單輸入，
                                Laravel 會辨識並覆蓋掉實際使用的 HTTP 請求方法。
                                產生的欄位看起來如下：

                                <input type="hidden" name="_method" value="DELETE">

                                --}}

                                <form action="/task/{{ $task->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>刪除任務
                                    </button>
                                </form>
                            </td>
                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- 代辦：目前任務 -->
@endsection