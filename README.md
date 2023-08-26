## Installation:

1. Download repository:
``` bash
  git clone git@github.com:SarasovMatvey/jwt.git
```

2. Go to project directory:
``` bash
cd jwt
```

3. Create configuration file:
``` bash
mv config/.env.example config/.env
```

3. Initialize project via Makefile:
``` bash
make init
```

4. Finally - run :)
``` bash
make run
```

## Additional info:

- Run code style fixer:
``` bash
make cs
```

- Run speed tests:
``` bash
make speed-tests
```

- Run functional tests:
``` bash
make functional-tests
```

- Run unit tests:
``` bash
make unit-tests
```
