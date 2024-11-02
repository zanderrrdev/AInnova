# AInnova

**AInnova** is a [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) plugin for Minecraft PE servers (versions 1.1.0 - 1.1.7) that allows you to send requests to an AI API and receive responses asynchronously. This plugin facilitates easy interaction with AI models within your Minecraft server.

## Features
- Send messages to AI and receive responses.
- Asynchronous processing to avoid blocking the main server thread.
- Configurable API token (available at [api.ai-nnova.ru](https://api.ai-nnova.ru)) and model.

## Installation
1. Download the AInnova plugin source files.
2. Extract the files into a folder named `AInnova`.
3. Place the entire `AInnova` folder into the `plugins` directory of your [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) server.
4. Restart the server.

## Configuration
After installation, configure the API token and model in your code:

```php
$plugin = Main::getInstance();
$plugin->setToken('your_api_token_here'); // Get a token at api.ai-nnova.ru
$plugin->setModel('your_ai_model_here'); // Find available models at api.ai-nnova.ru/models
```

## To send a message to the AI, use the following method:

```php
$plugin->sendMessage('Hello, AI!', function (Server $server, array $response) {
    if (isset($response['message'])) {
        $server->getLogger()->info('AI Response: ' . $response['message']);
    } else {
        $server->getLogger()->error('Error: ' . json_encode($response));
    }
});
```

- This plugin is compatible with [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) version 3.0.0 and Minecraft PE versions 1.1.0 to 1.1.7.

**Contributing**

- If you would like to contribute to this project, feel free to open issues or pull requests.

**License**

- This project is licensed under the MIT License - see the LICENSE file for details.

**Acknowledgments**

- Thanks to the [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) community for their support and inspiration from various AI and plugin development resources.
