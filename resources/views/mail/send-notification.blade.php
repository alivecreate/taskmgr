<h3>હેલો {{$name}},</h3>
<p style="font-size: 15px;color: #862424;"><strong>{{$name}}</strong> એડમીન દ્વારા કામગીરી કૉમેન્ટસ:</p style="
    font-size: 15px;color: #862424;"
>
<table style="text-align:left;font-size: 16px;border-collapse: collapse; width:700px;margin-top: 20px"
 bordercolor="silver" border=1>

 <tr>
        <th colspan ="2" style="padding: 5px 10px;width: 30%;">{{$msg}}</th>
    </tr>

    <tr>
        <th style="padding: 5px 10px;width: 30%;">કામગીરી વ્યક્તિનું નામ</th>
        <td style="padding: 5px 10px;width: 70%;">{{$name}}</td>
    </tr>

    <tr>
        <th  style="padding: 5px 10px;width: 30%;">ટાસ્કનું નામ</th>
        <td style="padding: 5px 10px;width: 70%;">{{$task_name}}</td>
    </tr>
    <tr>
        <th  style="padding: 5px 10px;width: 30%;">ટાસ્કની વિગત</th>
        <td style="padding: 5px 10px;width: 70%;">{{$task_assign_description}}</td>
    </tr>
    <tr>
        <th  style="padding: 5px 10px;width: 30%;">અરજદારનું નામ</th>
        <td style="padding: 5px 10px;width: 70%;">{{$client_name}}</td>
    </tr>
    <tr>
        <th  style="padding: 5px 10px;width: 30%;">અરજદારનો ફોટો</th>

        <td style="padding: 5px 10px;width: 70%;"><img src="{{$client_photo}}" alt=""></td>
    </tr>

    <tr>
        <th  style="padding: 5px 10px;width: 30%;">સંપૂર્ણ વિગત જોવા</th>
        <td style="padding: 5px 10px;width: 70%;"><a href="{{$url}}">ક્લિક કરો</a></td>
    </tr>
    
</table>

<br><br>
<strong>Thanks,</strong><br>
<strong>Task Manager</strong>