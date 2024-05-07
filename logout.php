<?php
//logout function
session_start();
session_destroy();

echo "<script>alert('Berhasil Logout!')</script>";
echo "<br/><a>Success Logout. Please wait</a>";
echo "<script>setTimeout(function(){ window.location.href = './'; }, 1000);</script>";
?>