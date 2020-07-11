build:
	docker build -t invo-mongodb .

exec:
	docker run --rm -it \
		-v $(CURDIR):/app \
		--network dev \
		invo-mongodb bash

serve:
	docker run --rm -it \
		-v $(CURDIR):/app \
	  	--name invo-mongodb \
		--network dev \
		-p 80:80 \
		invo-mongodb

db:
	docker run --rm -d \
		--network dev \
		--name mongodb \
		-p 27017:27017 \
		mongo
