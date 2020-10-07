<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <table border='1'>
            <tr>
                <td>id</td>
                <td>名称</td>
                <td>邮箱</td>
                <td>注册时间</td>
                <td>操作</td>
            </tr>
            @foreach($res as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->user_name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->reg_time}}</td>
                <td>
                    <a href="{{'delete/'.$v->id}}">删除</a>
                    <a href="{{'edit/'.$v->id}}">修改</a>
                </td>
            </tr>
            @endforeach
        </table>
    </form>
</body>
</html>