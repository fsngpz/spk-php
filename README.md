# Fixes
Root cause ->  `Warning: mysqli::__construct(): (HY000/2002): No such file or directory in`

Same issue [here](https://stackoverflow.com/questions/55012026/warning-mysqli-construct-hy000-2002-no-such-file-or-directory-in)

How to fix?
use `$config["server"]='127.0.0.1'` of using `$config["server"]='localhost'` for the name of the server.

# Notes

Make sure your mysql server is running on port **3306**.
