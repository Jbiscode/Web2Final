<?php

include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/dbconn.php";

$seq = $_GET['seq'];
$visitor_name = $_GET['visitor_name'];
$visit_seq = $_GET['visit_seq'];

$query = "DELETE FROM visit WHERE seq = '$visit_seq'";

$result = $connect->query($query) or die($connect->errorInfo());
?>
<input type="hidden" name="seq" id="seq" value="<?php echo $seq ?>">
<script>
    alert('방명록이 삭제되었습니다.');
    location.href = "/방명록/visit.php?seq=<?php echo $seq ?>";
</script>