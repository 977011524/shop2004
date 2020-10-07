<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/user/stoe')}}" method="POST">
    @csrf
        <table border='1'>
            <tr>
                <td>账号:</td>
                <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td>密码:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>邮箱:</td>
                <td><input type="email" name="email"></td>
            </tr>
           
           
            <tr>
                <td>操作</td>
                <td><input type="submit" value="添加"></td>
        </tr>
    </table>
    
       
        
    </form>
    
</body>
</html>