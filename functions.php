// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

<?php

 function fetchExperiments($user,$role){
     $link=mysqli_connect('127.0.0.1','root','MyNewPass','rub');

     if($role='student') {
         $query = mysqli_query($link, "SELECT * FROM experiments where student='$user'");
     }elseif ($role=='admin'){
         $query = mysqli_query($link, "SELECT * FROM experiments");
     }elseif ($role=='eao'){
         $query = mysqli_query($link, "SELECT * FROM experiments where eao LIKE '%$user%'");
     }
echo "<tr class=\"active border-double\">
                    <td colspan=\"2\">Recent Experiments</td>
                    <td class=\"text-right\">
                        <span class=\"badge bg-blue\">".mysqli_num_rows($query)." </span>
                    </td>
				</tr>";
     while ($a=mysqli_fetch_array($query)){
         if($a['status']=='pending'){
             $color='pink';
         }else{
             $color='teal';
         }
         echo "
                 <tr>
                    <td class=\"text-center\">
                        <h6 class=\"no-margin\">".$a['created']."</h6>
                    </td>
                    <td>
                        <div class=\"media-left media-middle\">
                            <a href=\"index.html#\" class=\"btn bg-".$color."-400 btn-rounded btn-icon btn-xs\">
                                <span class=\"letter-icon\"></span>
                            </a>
                        </div>
    
                        <div class=\"media-body\">
                            <div class=\"text-muted text-size-small\"><span class=\"status-mark border-".$color." position-left\"></span> ".$a['status']."</div>
                        </div>
                    </td>
                    <td>
                        <a href=\"index.html#\" class=\"text-default display-inline-block\">
                            <span class=\"text-semibold\">".$a['title']."</span>
                        </a>
                    </td>
                </tr>";
     }

 }

function countExperiments($user,$status,$role){
    $link = mysqli_connect('127.0.0.1', 'root', 'MyNewPass', 'rub');
     if($role='student') {
         if ($status == 'all') {
             $query = mysqli_query($link, "SELECT * FROM experiments where student='$user'");
             $count = mysqli_num_rows($query);
         } else {
             $query = mysqli_query($link, "SELECT * FROM experiments where student='$user' and status='$status'");
             $count = mysqli_num_rows($query);
         }
     }elseif ($role=='admin'){
         if ($status = 'all') {
             $query = mysqli_query($link, "SELECT * FROM experiments");
             $count = mysqli_num_rows($query);
         } else {
             $query = mysqli_query($link, "SELECT * FROM experiments where status='$status'");
             $count = mysqli_num_rows($query);
         }
     }elseif ($role=='eao'){
         if ($status = 'all') {
             $query = mysqli_query($link, "SELECT * FROM experiments where eao LIKE '%$user%'");
             $count = mysqli_num_rows($query);
         } else {
             $query = mysqli_query($link, "SELECT * FROM experiments where eao LIKE '%$user%' and status='$status'");
             $count = mysqli_num_rows($query);
         }
     }
     echo $count;
}


?>