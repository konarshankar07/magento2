<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Framework\Jwt\Jwe;

use Magento\Framework\Jwt\HeaderInterface;
use Magento\Framework\Jwt\HeaderParameterInterface;

class JweHeader implements HeaderInterface
{
    /**
     * @var JweHeaderParameterInterface[]
     */
    private $parameters;

    /**
     * @param JweHeaderParameterInterface[] $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = [];
        foreach ($parameters as $parameter) {
            if (!$parameter instanceof JweHeaderParameterInterface) {
                throw new \InvalidArgumentException(
                    sprintf('Header "%s" is not applicable to JWE tokens', $parameter->getName())
                );
            }
            $this->parameters[$parameter->getName()] = $parameter;
        }
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @inheritDoc
     */
    public function getParameter(string $name): ?HeaderParameterInterface
    {
        return !empty($this->parameters[$name]) ? $this->parameters[$name] : null;
    }
}
