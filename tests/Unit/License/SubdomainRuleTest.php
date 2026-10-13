<?php

namespace Tests\Unit\License;

use App\Exceptions\ValidationException;
use App\License\Models\LicenseUserService;
use App\License\ServiceModules\ShopSmsLicense\LicenseUserServiceRepository;
use App\License\SubdomainRule;
use Mockery;
use Mockery\MockInterface;
use Tests\Psr4\TestCases\UnitTestCase;

class SubdomainRuleTest extends UnitTestCase
{
    private MockInterface $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock(LicenseUserServiceRepository::class);
        $this->app->instance(LicenseUserServiceRepository::class, $this->repositoryMock);
    }

    /**
     * @test
     */
    public function fails_on_invalid_format()
    {
        $this->expectException(ValidationException::class);

        $rule = new SubdomainRule();
        $rule->validate("", "INVALID_SUBDOMAIN", []);
    }

    /**
     * @test
     */
    public function passes_with_valid_format()
    {
        $this->repositoryMock
            ->shouldReceive("findBySubdomain")
            ->with("valid-subdomain", null)
            ->andReturnNull();

        $rule = new SubdomainRule();
        $rule->validate("", "valid-subdomain", []);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function fails_when_subdomain_is_taken()
    {
        $this->repositoryMock
            ->shouldReceive("findBySubdomain")
            ->with("taken-sub", null)
            ->andReturn(Mockery::mock(LicenseUserService::class));

        $this->expectException(ValidationException::class);

        $rule = new SubdomainRule();
        $rule->validate("", "taken-sub", []);
    }

    /**
     * @test
     */
    public function passes_when_subdomain_belongs_to_current_service()
    {
        $this->repositoryMock
            ->shouldReceive("findBySubdomain")
            ->with("my-sub", 42)
            ->andReturnNull();

        $rule = new SubdomainRule();
        $rule->validate("", "my-sub", ["id" => "42"]);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function fails_when_subdomain_taken_by_different_service()
    {
        $this->repositoryMock
            ->shouldReceive("findBySubdomain")
            ->with("other-sub", 42)
            ->andReturn(Mockery::mock(LicenseUserService::class));

        $this->expectException(ValidationException::class);

        $rule = new SubdomainRule();
        $rule->validate("", "other-sub", ["id" => "42"]);
    }
}
