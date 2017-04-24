For install the application you must first install docker and docker-compose.
After you need to execute commands:
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
login: admin@calendar.dev
password: admin
~~~