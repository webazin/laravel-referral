<?php

namespace App\Webazin\Referral\src;

use App\Models\User;
use Illuminate\Http\Request;

trait ReferralTrait
{
    public function getRefLink(): string
    {
        return route('referral.redirect', ['affiliate_code' => $this->getReferralCode()]);
    }

    public function getReferralCode(): string
    {
        return $this->referral_code;
    }

    public function setReferralCode(): void
    {
        $this->update([
            'referral_code' => $this->hashUserId()
        ]);
    }

    private function hashUserId(): string
    {
        return md5($this->id);
    }

    public function getUserByReferral($code)
    {
        return User::where('referral_code', $code)->first();
    }

    public function getParent()
    {
        if ($this->parent_id) {
            return User::find($this->parent_id);
        }
        return null;
    }

    public function setParentId($code)
    {
        $this->update([
            'parent_id' => $this->getUserByReferral($code)
        ]);
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getReferralCodeFromCookie(): array|string|null
    {
        return cookie()->get('referral');
    }
}
