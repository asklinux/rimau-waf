# WAF Sektor Awam (WSA) #

WSA is a project initiated by MAMPU. 

### What is this repository for? ###

* Development of this project is in coaching mode. Lead by MAMPU in collaboration with Ofisgate, team consists of IT Officer from various agencies.
* Version 1.0

### How do I get set up? ###

* ModSecurity 2.2.9 current phase
*Centos 7 with php 7
*Use epel repos change configure
### apache setup ###
*$visudo
*add this configure
*User_Alias WWW_USER = apache Cmnd_Alias WWW_COMMANDS = /usr/bin/systemctl,/usr/bin/ln,/usr/bin/unlink,/usr/share/mampu/run.sh,/usr/bin/tail,/usr/bin/sed,/usr/bin/cat,/usr/bin/grep,/usr/sbin/apachectl WWW_USER localhost = (ALL) NOPASSWD:WWW_COMMANDS
*run selinux rules add
*$semanage permissive -a httpd_t

### nginx setup ###

*$visudo
*add this configure
*User_Alias WWW_USER = php-fpm Cmnd_Alias WWW_COMMANDS = /usr/bin/systemctl,/usr/bin/ln,/usr/bin/unlink,/usr/share/mampu/run.sh,/usr/bin/tail,/usr/bin/sed,/usr/bin/cat,/usr/bin/grep,/usr/sbin/apachectl WWW_USER localhost = (ALL) NOPASSWD:WWW_COMMANDS
*run selinux rules add
*$semanage permissive -a httpd_t

### Contribution guidelines ###

* Hasnan (UI/UX Head of Designer)
* Mani (Arhitect Engineer)
* Muiz (Anamoly Scoring Engineer)
* Anuar (Anamoly Scoring Engineer)
* Shaiful (ModSec Engine Tuning)
* Simon (Custom Rules Integrator)
* Mazni (Custom Rules Integrator)
* AB (Rules Integrator)
* Wira (Code Integrator)
* Nawawi (Project Manager)
* Tajul (Evangelist)
* Amal (Technical Writer)

### Who do I talk to? ###

* This project not yet decided to release on any Open Source Licenses or any, however the current project maintained by the Government of Malaysia in collaboration with Ofisgate
* Any enquiries: nawawi@mampu.gov.my (Government) / tajul@ofisgate.com.my (Commercial)