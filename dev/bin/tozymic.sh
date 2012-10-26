#!/bin/bash
# sends the directory named as argument to our zymic server
# $1 is directory to send to zymic through FTP
if [ $# != 1 ];
then
    echo -e "USAGE: $(basename $0) dir\n"
    echo -e "NOTE: make sure the directory exists remotely ready"
    exit 1
fi

HOST=cecs491mock.zxq.net
USER=cecs491mock_zxq
PASS=practicesite

ftp -pinv $HOST <<EOF
 EOF
user $USER $PASS
mkdir $1
mput $1/**

bye
EOF
