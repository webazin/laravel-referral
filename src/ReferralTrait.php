<?php

namespace Webazin\Referral;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

trait ReferralTrait
{
    public function __construct()
    {
        $this->fillable[] = 'parent_id';
        $this->fillable[] = 'referral_code';
    }

    public function getRefLink(): string
    {
        return route('referral.redirect', ['affiliate_code' => $this->getReferralCode()]);
    }

    public function getReferralCode(): string
    {
        if (!$this->referral_code) {
            $this->setReferralCode();
        }
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

    public function setParentId()
    {
        if ($this->getReferralCodeFromCookie()) {
            if ($this->getUserByReferral($this->getReferralCodeFromCookie())?->id != $this->id) {
                $this->update([
                    'parent_id' => $this->getUserByReferral($this->getReferralCodeFromCookie())?->id
                ]);
                $this->deleteCookie();
            }
        }
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getReferralCodeFromCookie(): array|string|null
    {
        return Cookie::get('referral');
    }

    private function deleteCookie()
    {
        Cookie::forget('referral');
    }
}
