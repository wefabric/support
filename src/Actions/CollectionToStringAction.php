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
            $value = $item;
            if(!is_numeric($item)) {
                $value = $item->{$key};
            }

            if(0 === $itemKey) {
                $result .= $value;
            }

            if(0 !== $itemKey && $collection->count() - 1 === $itemKey) {

                if(!$lastItemText) {
                    $lastItemText = __('of');
                }

                $result .= ' '.$lastItemText.' '.$value;
            } elseif(0 !== $itemKey){
                $result .= ', '.$value;
            }
        }
        return $result;
    }

}
