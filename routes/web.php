<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Task;
use Illuminate\Http\Request;


// 將這些路由包在 web 中介層內，這樣它們會擁有 session 狀態及 CSRF 保護。


/**
 * 用於顯示所有任務的清單
 */
Route::get('/', function () {

    // 傳遞所有已有的任務至視圖。
    $tasks = Task::orderBy('created_at', 'asc')->get();

    /*
     * $view:
     * 傳遞 tasks 至 view 函式會建立一個視圖物件實例，
     * 它會對應至 resources/views/tasks.blade.php 模板
     * Laravel 所有的視圖都被儲存在 resources/views
     *
     * $data:
     * view 函式接收一個能在視圖中取用之資料的陣列作為第二個參數，
     * 陣列中的每個鍵都會在視圖中作為變數：
     */
    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * 增加新的任務
 */
Route::post('/task', function (Request $request) {

    /*
     * 讓 name 欄位為必填，且它必須少於 255 字元。
     */
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    /*
     * 如果驗證失敗，我們會將使用者重導回 / URL，
     * 並將舊的輸入及錯誤訊息快閃至 session。
     * 快閃該輸入至 session 能讓我們保留使用者的輸入，即使有驗證錯誤
     */
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // 驗證通過

    // 建立該任務...
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
 * 刪除任務
 *
 * 使用 隱式模型綁定 {task} => $task
 */
Route::delete('/task/{task}', function (Task $task) {

    /*
     * 隱式綁定

        Laravel 會自動解析路由或控制器行為中變數名稱與路由片段名稱相符，
        並由型別提示所定義的 Eloquent 模型
     */

    $task->delete();

    return redirect('/');
});
