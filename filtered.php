<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <titleJobs</title>
    <style>
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            font-size: 2.5em;
            line-height: 1.5;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 2.0em;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>


</head>
<body>
<?php include('header.php')?>
<br><br>
<?php include('dbconnect.php')?>


<?php
// Load the job preferences of all users
$sql = "SELECT userid, jobid, rating FROM user_preferences";
$preferences_result = mysqli_query($con, $sql);
$preferences = array();
while ($row = mysqli_fetch_assoc($preferences_result)) {
    $preferences[] = $row;
}

// Compute the item similarities
$item_sum_squares = array();
$item_similarities = array();
foreach ($preferences as $p1) {
    $item1 = $p1['jobid'];
    if (!isset($item_sum_squares[$item1])) {
        $item_sum_squares[$item1] = 0;
    }
    $item_sum_squares[$item1] += pow($p1['rating'], 2);
    foreach ($preferences as $p2) {
        $item2 = $p2['jobid'];
        if ($item1 == $item2) {
            continue;
        }
        $rating1 = $p1['rating'];
        $rating2 = $p2['rating'];
        if (!isset($item_similarities[$item1][$item2])) {
            $item_similarities[$item1][$item2] = 0;
        }
        $item_similarities[$item1][$item2] += $rating1 * $rating2;
    }
}
foreach ($item_similarities as $item1 => &$similarity_row) {
    foreach ($similarity_row as $item2 => &$similarity) {
        $similarity /= sqrt($item_sum_squares[$item1] * $item_sum_squares[$item2]);
    }
}

// Get the jobs rated by the user
$user_id = $_SESSION['userid'];
$sql = "SELECT jobid, rating FROM user_preferences WHERE userid = $user_id";
$user_preferences_result = mysqli_query($con, $sql);
$user_preferences = array();
while ($row = mysqli_fetch_assoc($user_preferences_result)) {
    $user_preferences[$row['jobid']] = $row['rating'];
}

// Compute the predicted ratings for each unrated job
$job_ratings = array();
foreach ($item_similarities as $job_id => $item_similarity_row) {
    $total_similarity = 0;
    $weighted_rating_sum = 0;
    if (!isset($user_preferences[$job_id])) {
        foreach ($user_preferences as $user_job_id => $user_rating) {
            $similar_item_rating = $preferences[array_search($user_job_id, array_column($preferences, 'jobid'))]['rating'];
            $similarity = $item_similarities[$job_id][$user_job_id];
            $total_similarity += $similarity;
            $weighted_rating_sum += $similarity * ($user_rating - $similar_item_rating);
        }
        if ($total_similarity > 0) {
            $sql = "SELECT name FROM jobs WHERE jobid = $job_id";
            $job_name_result = mysqli_query($con, $sql);
            $job_name_row = mysqli_fetch_assoc($job_name_result);
            $job_name = $job_name_row['name'];
            $job_rating = $weighted_rating_sum / $total_similarity;
            $job_ratings[$job_name] = $job_rating;
        }
    }
}
arsort($job_ratings);

// Output as a table

// Output as a table
echo '<table class="table"><thead><tr><th>Recommended Jobs</th></tr></thead><tbody>';
$counter = 0;
foreach ($job_ratings as $job_name => $job_rating) {
    echo '<tr><td>' . $job_name . '</td><td>' . '</td></tr>';
    $counter++;
    if ($counter == 3) {
        break;
    }
}
echo '</tbody></table>';
?>



<br><br>
<?php include('footer.php'); ?>


</body>
</html>