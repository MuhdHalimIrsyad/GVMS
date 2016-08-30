<?php
//$2y$10$JnlxpVe7BcH0b7VdgkDZ0.sX33p28jyl7sfB8I2bq6o8BZqQ4I7hW
echo password_hash("12345", PASSWORD_BCRYPT)."<br>";

echo password_verify('12345', '$2y$10$f/crKJRHkWKpg/QA2c5y4uvsQuyEpxxE0LIaKor29CVdgqzZzyYJW')."\n";
?>