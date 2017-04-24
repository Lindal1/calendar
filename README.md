In order to install the application you must first install docker and docker-compose.
After execute next command:
~~~
git clone https://github.com/Lindal1/calendar.git
cd calendar/docker
docker-compose up -d
docker exec -ti docker_web_1 composer install
docker exec -ti docker_web_1 php yii migrate
~~~

After follow to calendar.dev
We have one admin account: 
~~~
login: admin@calendat.dev
password: admin
~~~