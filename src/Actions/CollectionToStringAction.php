<?php


namespace Wefabric\Support\Actions;


use Illuminate\Support\Collection;

class CollectionToStringAction
{

    /**
     * @param Collection $collection
     * @param string $key
     * @param string $lastItemText
     * @return string
     */
    public function execute(Collection $collection, string $key = 'title', string $lastItemText = ''): string
    {
        $result = '';
        foreach ($collection as $itemKey => $item) {
            if(0 === $itemKey) {
                $result .= $item->{$key};
            }

            if(0 !== $itemKey && $collection->count() - 1 === $itemKey) {

                if(!$lastItemText) {
                    $lastItemText = __('of');
                }

                $result .= ' '.$lastItemText.' '.$item->{$key};
            } elseif(0 !== $itemKey){
                $result .= ', '.$item->{$key};
            }
        }
        return $result;
    }

}
