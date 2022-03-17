# Agrabah Traceability

Agrabah Traceability allows community leaders to trace the delivery of a produce from the farmer to the market.

Agrabah was created to empower Filipino Farmers & Fisherfolks to steadily earn fair profit through online platforms that connect them to partners and consumers.

Products are directly sourced from more than 5,000 farmers and fisherfolks nationwide across the Philippines and growing. Agrabah provides farmers with a stable market channel which allows for inclusive economic growth.

Agrabah knows that with a better marketplace, we can help our Filipino farmers and fisher folks enjoy a sustained and rewarding livelihood.

# Getting Started - Local Development

# Agrabah Logistics

```
git clone https://github.com/abaam/trace
```

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

* Create your database and update the database configuration in your env

```
php artisan migrate
```

```
php artisan db:seed
```

```
php artisan serve
```
