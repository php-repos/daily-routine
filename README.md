# Daily Routine Application

## Introduction

Daily Routine is a simple PHP application designed to help you start your day on the right foot. It features several useful tools, including:

- A RAM and hard drive status display
- A list of cryptocurrency prices
- A weather forecast for the next 5 days
- A section for displaying news headlines

This application was developed primarily to demonstrate how to use phpkg's `serve` command.

> **Note**  
> For more information about the phpkg's serve command, check its [documentation](https://phpkg.com/documentations/serve-command).

![daily-routine-screenshot.png](daily-routine-screenshot.png)

## Usage

### Standalone application

Daily Routine is a standalone application that can be easily launched on any machine using the `phpkg serve` command. 
Simply run the following command:

```shell
phpkg serve https://github.com/php-repos/daily-routine.git
```

To take advantage of all the implemented features, you'll need to have the following environment variables defined in your operating system:

```shell
// Get an api key from https://pro.coinmarketcap.com/signup/
COINMARKETCAP_API_KEY='your-api-key'

// Get an api key from https://newsapi.org/register
NEWSAPI_API_KEY='your-api-key'

// Get an api key from https://home.openweathermap.org/users/sign_up
OPENWEATHERMAP_API_KEY='your-api-key'
```

You do not need to add all keys, only define the ones you require.

> **Note**
> For all services, having a developer api key will be more than enough for daily usage.

### Usage as a package

You can also install Daily Routine as a package in your own projects by using the `phpkg add` command:

```shell
phpkg add https://github.com/php-repos/daily-routine.git
```

This will add the Daily Routine package to your project, allowing you to take advantage of all its features and functions.
