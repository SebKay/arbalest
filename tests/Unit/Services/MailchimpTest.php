<?php

namespace ArbalestTests\Unit\Services;

use Arbalest\Services\Mailchimp;

test('It can hash an email address', function () {
    expect(Mailchimp::subscriberHash('test@test.com'))->toBe('b642b4217b34b1e8d3bd915fc65c4452');
});
